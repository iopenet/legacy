/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	//config.uiColor = '#272c35';
	//config.removePlugins = 'image';
	config.extraPlugins = 'autogrow';

    config.protectedSource.push( /\<{[\s\S]*?\}>/g );

    config.autoGrow_minHeight = 480;
    config.autoGrow_maxHeight = 640;
    config.autoGrow_bottomSpace = 50;
        // Register custom context for image widgets on the fly.
        config.editor.balloonToolbars.create({
            buttons: 'Link,Unlink,Image',
            widgets: 'image'
          });
};
