<?php

namespace app\components;

use Yii;
use yii\helpers\ArrayHelper;

/**
* Set de helpers que extienden la clase ArrayHelper, para filtrado, swap y extraccion
* @author Jeancarlo Fontalvo
* @since 1.0
*/
class ArrayHelperFilter extends ArrayHelper
{
    public static function filter($model, $columns)
    {
        return static::map($model::find()->all(), $columns[ "value" ], $columns[ "text" ]);
    }

    /**
    * Remueve elementos o llaves
    * @since 1.1
    */
    public static function remove($array, $keys)
    {
        $haveKeys   = false;
        $count      = 1;
        $arr        = static::merge($array, []);
        $indexes    = [];
        $Notfirst   = false;
        foreach($keys as $key)
        {
            if(array_key_exists( $key, $arr ))
            {
                $keysAsoc[ $key ]   = "";
                $haveKeys           = true;
            }
            else
            {
                $index = array_search( $key, $arr );
                if($index !== false)                    
                    array_push( $indexes, $index );
            }
        }

        if($haveKeys)
        {
            $arr = array_diff_key($arr, $keysAsoc);
        }
        else
        {
            sort($indexes);
            foreach($indexes as $index)
            {
                
                if($Notfirst)
                {
                    $index -= $count;
                    $count++;
                }
                                        
                array_splice($arr, $index, 1);
                
                $Notfirst = true;
            }   
        }
        
        return $arr;
    }

    public static function addPrefix($array, $prefix = "", $separator = ".")
    {
        $arr    = static::merge($array, []);
        
        if(count($arr) > 0)
        {
            foreach($arr as $key => $item)
            {
                $type = gettype($item);
                if( $type === "string" )
                    $arr[ $key ] = ( ($prefix !== "") ? $prefix . $separator : "" ) . $item;
            }
        }
        
        return $arr;
    }

    public static function swap($array, $swaps)
    {
        $arr    = [];
        $keys   = array_keys( $array );
        $vals   = array_values( $array );

        foreach($swaps as $origin => $destiny )
        {
            $originPos  = array_search($origin, $keys);
            $destinyPos = array_search($destiny, $keys);

            $tempKey               = $keys[ $originPos ];
            $tempVal               = $vals[ $originPos ];

            $keys[ $originPos ]    = $keys[ $destinyPos ];
            $vals[ $originPos ]    = $vals[ $destinyPos ];

            $keys[ $destinyPos ]    = $tempKey;
            $vals[ $destinyPos ]    = $tempVal;
        }

        $arr = array_combine($keys, $vals);

        return $arr;
    }

    public static function swapByIndex($array, $positions)
    {
        $arr    = [];
        $keys   = array_keys( $array );
        $vals   = array_values( $array );

        foreach($positions as $key => $index )
        {
            $originPos  = array_search($key, $keys);
            $destinyPos = $index;

            $tempKey               = $keys[ $originPos ];
            $tempVal               = $vals[ $originPos ];

            $keys[ $originPos ]    = $keys[ $destinyPos ];
            $vals[ $originPos ]    = $vals[ $destinyPos ];

            $keys[ $destinyPos ]    = $tempKey;
            $vals[ $destinyPos ]    = $tempVal;
        }

        $arr = array_combine($keys, $vals);

        return $arr;
    }

    public static function move($array, $positions)
    {
        $arr    = [];
        $keys   = array_keys( $array );
        $vals   = array_values( $array );
        
        foreach($positions as $key => $index )
        {
            $originPos      = array_search($key, $keys);
            $destinyPos     = $index;
           
            $movedKeys      = [];
            $movedValues    = [];
    
            $tempKey        = array_splice($keys, $originPos, 1);
            $tempVal        = array_splice($vals, $originPos, 1);

            $movedKeys      = array_splice($keys, $destinyPos, count($keys), $tempKey );
            $movedValues    = array_splice($vals, $destinyPos, count($vals), $tempVal );
            
            $keys           = array_merge( $keys, $movedKeys );
            $vals           = array_merge( $vals, $movedValues );

        }

        $arr = array_combine($keys, $vals);

        return $arr;
    } 

}

?>