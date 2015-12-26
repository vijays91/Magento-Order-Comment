<?php
class Learn_OrderComment_Block_Adminhtml_Sales_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    protected $_ambiguousColumns = array(
        'status',
        'created_at',
    );

    protected function _getCollectionClass() {
        return 'ordercomment/order_grid_collection';
    }

    protected function _prepareColumns()
    {
        parent::_prepareColumns();

        // Add order comment to grid
        $this->addColumn('ordercomment', array(
            'header'       => Mage::helper('ordercomment')->__('Order Comment'),
            'index'        => 'ordercomment',
            'filter_index' => 'ordercomment_table.comment',
        ));

        // Fix integrity constraint violation in SELECT
        foreach ($this->_ambiguousColumns as $index) {
            if (isset($this->_columns[$index])) {
                $this->_columns[$index]->setFilterIndex('main_table.' . $index);
            }
        }

        return $this;
    }
}
