<?php

class Bestchoice_Recipe_Block_Adminhtml_Recipe_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'recipe';
        $this->_controller = 'adminhtml_recipe';
        
        $this->_updateButton('save', 'label', Mage::helper('recipe')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('recipe')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('recipe_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'recipe_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'recipe_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('recipe_data') && Mage::registry('recipe_data')->getId() ) {
            return Mage::helper('recipe')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('recipe_data')->getTitle()));
        } else {
            return Mage::helper('recipe')->__('Add Item');
        }
    }
}