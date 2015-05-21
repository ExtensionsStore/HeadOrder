<?php

/**
 * Observer
 *
 * @category   Aydus
 * @package    Aydus_HeadOrder
 * @author     Aydus <davidt@aydus.com>
 */

class Aydus_HeadOrder_Model_Observer 
{
    /**
     * 
     * @see controller_action_layout_generate_blocks_after
     * @param Varien_Event_Observer $observer
     */
    public function reorderHeadItems($observer)
    {
        $layout = $observer->getLayout();
        $block = $layout->getBlock('head');
        $items = $block->getItems();
        
        $jsStr = Mage::getStoreConfig('design/head/js');
        $cssStr = Mage::getStoreConfig('design/head/css');
        
        $jsAr = explode("\n", $jsStr);
        $cssAr = explode("\n", $cssStr);
        
        if ((is_array($jsAr) && $jsAr[0])){
            foreach ($jsAr as $i=>$js){
                $js = trim($js);
                $jsKey = "js/$js";
                $skinJsKey = "skin_js/$js";
                if (isset($items[$jsKey])){
                    $item = &$items[$jsKey];
                } else if (isset($items[$skinJsKey])) {
                    $item = &$items[$skinJsKey];
                }

                if (is_array($item) && count($item)>0){
                    $position = $i+1;
                    $item['position'] = $position;
                }
            }
        }
            
        if (is_array($cssAr) && $cssAr[0]){
            foreach ($cssAr as $i=>$css){
                $css = trim($css);
                $cssKey = "css/$css";
                $skinCssKey = "skin_css/$css";
                if (isset($items[$cssKey])){
                    $item = &$items[$cssKey];
                } else if (isset($items[$skinCssKey])) {
                    $item = &$items[$skinCssKey];
                }

                if (is_array($item) && count($item)>0){
                    $position = $i+1;
                    $item['position'] = $position;
                }                
            }            
        }

        function positionSort($a, $b)
        {
            $aPosition = (isset($a['position'])) ? (int)$a['position'] : 999;
            $bPosition =  (isset($b['position'])) ? (int)$b['position'] : 999;

            return ($aPosition < $bPosition) ? -1 : 1;
        }

        usort($items, 'positionSort');

        $block->setItems($items);            
        
    }
    
}