<?php 
namespace Admin\Controllers;

class Language extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItemCollection;
    use \Dsc\Traits\Controllers\SupportPreview;

    protected $list_route = '/admin/languages';
    protected $create_item_route = '/admin/language/create';
    protected $get_item_route = '/admin/language/read/{id}';    
    protected $edit_item_route = '/admin/language/edit/{id}';
    
    protected function getModel() 
    {
        $model = new \Dsc\Mongo\Collections\Translations\Languages;
        return $model; 
    }
    
    protected function getItem() 
    {
        $f3 = \Base::instance();
        $id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );
        $model = $this->getModel()
            ->setState('filter.id', $id);

        try {
            $item = $model->getItem();
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
            $f3->reroute( $this->list_route );
            return;
        }

        return $item;
    }
    
    protected function displayCreate() 
    {
        $f3 = \Base::instance();
        
        $item = $this->getItem();
        
        $this->app->set('meta.title', 'Create Item');
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayTranslationsLanguageEdit', array( 'item' => $item, 'tabs' => array(), 'content' => array() ) );
        
        echo $view->render('Admin/Views::languages/create.php');
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();

        $item = $this->getItem();
        $this->app->set('meta.title', 'Edit Item');
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayTranslationsLanguageEdit', array( 'item' => $item, 'tabs' => array(), 'content' => array() ) );
        
        echo $view->render('Admin/Views::languages/edit.php');
    }
    
    /**
     * This controller doesn't allow reading, only editing, so redirect to the edit method
     */
    protected function doRead(array $data, $key=null) 
    {
        $f3 = \Base::instance();
        $id = $this->getItem()->get( $this->getItemKey() );
        $route = str_replace('{id}', $id, $this->edit_item_route );
        $f3->reroute( $route );
    }
    
    protected function displayRead() {}
    
    public function strings()
    {
        $item = $this->getItem();
    
        $this->app->set('meta.title', 'Edit Strings');
        $this->app->set( 'item', $item );
    
        echo $this->theme->render('Admin/Views::languages/strings.php');
    }
    
    public function stringsUpdate()
    {
        try {
            $language = $this->getItem();
            if (empty($language->id)) {
                throw new \Exception('Invalid Language');
            }

            // get the strings for the selected language
            // and add this new key/value pair to it
            $strings = (new \Translations\Models\Strings)->setState('filter.lang_id', $language->id)->getItem();
            if (empty($strings->id)) {
                $strings = new \Translations\Models\Strings;
                $strings->language_code = $language->code;
                $strings->language_id = $language->id;
            }
            
            $data = \Base::instance()->get('REQUEST');
            $strings->strings = array_filter( array_merge( $strings->strings, $data['strings'] ) ); 
            $strings->save();
            
            \Dsc\System::addMessage('Strings updated', 'success');
        }
        catch (\Exception $e) {
            \Dsc\System::addMessage( $e->getMessage(), 'error' );
        }
    
        $this->app->reroute('/admin/language/' . $language->id . '/strings');
    }
    
    public function createKey()
    {
        try {
            $language = $this->getItem();
            if (empty($language->id)) {
                throw new \Exception('Invalid Language');
            }
            
            // does the key already exist in the system?
            $title = $this->app->get('REQUEST.title');
            $slug = \Web::instance()->slug( $title );
            $key = (new \Translations\Models\Keys)->set('title', $title)->set('slug', $slug)->save();
            if (empty($key->id)) {
                throw new \Exception('Unable to save Key');
            }
            
            // get the strings for the selected language
            // and add this new key/value pair to it
            $strings = (new \Translations\Models\Strings)->setState('filter.lang_id', $language->id)->getItem();
            if (empty($strings->id)) {
                $strings = new \Translations\Models\Strings;
                $strings->language_code = $language->code;
                $strings->language_id = $language->id;
            }
            $strings->strings[$slug] = $this->app->get('REQUEST.value');
            $strings->save();

            return $this->outputJson($this->getJsonResponse(array(
                'error' => false,
                'html' => 'New string successfully added to language'
            )));
        }
        catch (\Exception $e) {
            return $this->outputJson($this->getJsonResponse(array(
                'error' => true,
                'html' => $e->getMessage()
            )));
        }
        

    }
}