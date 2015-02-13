/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
        { name: 'document',      groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
        { name: 'links' },
        { name: 'insert' },
        { name: 'forms' },
		
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Se the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	
	// allow all content
	config.allowedContent = true;

	// stop turning <br/> to <p>&nbsp;</p>
	config.autoParagraph = false;
	
	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	
	// enable shift+ENTER to add <br/>
	config.extraPlugins = 'enterkey';

	config.height = '450px';
	
	// allow i tags to be empty (for font awesome)
    config.protectedSource.push(/<i[^>]><\/i>/g);
    CKEDITOR.dtd.$removeEmpty['i'] = false;
    
    // default to the Source view 
    config.startupMode = 'source';
};
