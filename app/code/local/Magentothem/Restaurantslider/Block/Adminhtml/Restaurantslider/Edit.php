<?php

class Magentothem_Restaurantslider_Block_Adminhtml_Restaurantslider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'restaurantslider';
        $this->_controller = 'adminhtml_restaurantslider';
        
        $this->_updateButton('save', 'label', Mage::helper('restaurantslider')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('restaurantslider')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('restaurantslider_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'restaurantslider_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'restaurantslider_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('restaurantslider_data') && Mage::registry('restaurantslider_data')->getId() ) {
            return Mage::helper('restaurantslider')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('restaurantslider_data')->getTitle()));
        } else {
            return Mage::helper('restaurantslider')->__('Add Item');
        }
    }
}