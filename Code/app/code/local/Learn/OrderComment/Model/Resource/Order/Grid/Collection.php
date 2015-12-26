<?php
class Learn_OrderComment_Model_Resource_Order_Grid_Collection extends Mage_Sales_Model_Mysql4_Order_Grid_Collection
{
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->joinLeft(
            array('ordercomment_table' => $this->getTable('sales/order_status_history')),
            'main_table.entity_id = ordercomment_table.parent_id AND ordercomment_table.comment IS NOT NULL',
            array(
                'ordercomment' => 'ordercomment_table.comment',
            )
        )->group('main_table.entity_id');

        return $this;
    }

    public function getSelectCountSql()
    {
        return parent::getSelectCountSql()->reset(Zend_Db_Select::GROUP);
    }
}
