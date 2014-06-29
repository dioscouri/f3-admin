<?php 
namespace Admin\Models;

class Navigation extends \Dsc\Mongo\Collections\Navigation 
{
    /**
     * Converts this to a search item, used in the search template when displaying each search result
     */
    public function toAdminSearchItem()
    {
        $image = (!empty($this->{'featured_image.slug'})) ? './asset/thumb/' . $this->{'featured_image.slug'} : null;
    
        $item = new \Search\Models\Item(array(
            'url' => './admin/menu/edit/' . $this->id,
            'title' => $this->title,
            'subtitle' => $this->path,
            'image' => $image,
            'summary' => '<a href="' . $this->{'details.url'} . '" target="_blank">' . $this->{'details.url'} . '</a>',
            'datetime' => null,
        ));
    
        return $item;
    }    
}