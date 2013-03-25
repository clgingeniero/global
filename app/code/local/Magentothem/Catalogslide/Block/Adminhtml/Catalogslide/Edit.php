<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Catalogslide_Block_Adminhtml_Catalogslide_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'catalogslide';
        $this->_controller = 'adminhtml_catalogslide';
        
        $this->_updateButton('save', 'label', Mage::helper('catalogslide')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('catalogslide')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('catalogslide_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'catalogslide_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'catalogslide_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('catalogslide_data') && Mage::registry('catalogslide_data')->getId() ) {
            return Mage::helper('catalogslide')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('catalogslide_data')->getTitle()));
        } else {
            return Mage::helper('catalogslide')->__('Add Item');
        }
    }
}