<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('setNodeAuth'))
{
	function setNodeAuth($modules=array(), $auths=array())
	{
		$json = '';			
		foreach($modules as $k=>$v) {
			if (!empty($json)) $json .= ', ';
			
			$children = '';
			if (!empty($v['auth'])) {
				
				$expArr = explode('|', $v['auth']);
				for($fx=0; $fx<@count($expArr); $fx++)
				{
					
					if(strtolower(trim($expArr[$fx])) !== 'view')
					{
						
						if (!empty($children)) $children .= ', ';
						$children .= '{
							"text":"'.trim($expArr[$fx]).'", 
							"id":"'.$v['id'].'-'.trim($expArr[$fx]).'", 
							"stateId":"state-'.$v['id'].'-'.trim($expArr[$fx]).'", 
							"itemId":"item-'.$v['id'].'-'.trim($expArr[$fx]).'", 
							"leaf":true,
							"value":"'.$v['id'].'-'.strtolower(trim($expArr[$fx])).'",
							"checked": '. ( isset($auths[(string) $v['id']][strtolower(trim($expArr[$fx]))]) ? 'true' : 'false' ) .'					
						  }';
						
					}
					
				}
				
			}
						
			$json .= '{
						"text":"'.$v['title'].'",
						"id":"'.$v['id'].'-view", 
						"stateId":"state-'.$v['id'].'", 
						"itemId":"item-'.$v['id'].'", 
						"leaf":'.( !empty($children) ?  'false' : ( $v['menutype'] == 'NODE' ? 'true' : 'false' ) ).',
						"value":"'.$v['id'].'-view",
						"checked": '. ( isset($auths[(string) $v['id']]['view']) ? 'true' : 'false' ) . ( !empty($children) ? ', "children":['.$children.']' : '' ) .'												
					  }';
					  
			
		}

		return $json;
	}
}