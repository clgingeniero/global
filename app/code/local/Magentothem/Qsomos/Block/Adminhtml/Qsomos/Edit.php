<?php
/*------------------------------------------------------------------------
# Websites: http://www.plazathemes.com/
-------------------------------------------------------------------------*/ 
class Magentothem_Qsomos_Block_Adminhtml_Qsomos_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'qsomos';
        $this->_controller = 'adminhtml_qsomos';
        
        $this->_updateButton('save', 'label', Mage::helper('qsomos')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('qsomos')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('qsomos_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'qsomos_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'qsomos_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('qsomos_data') && Mage::registry('qsomos_data')->getId() ) {
            return Mage::helper('qsomos')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('qsomos_data')->getTitle()));
        } else {
            return Mage::helper('qsomos')->__('Add Item');
        }
    }
}