<?php

class GroupByInterval
{

    public function group($range, $list)
    {
        if (is_null($range)) {
            return [];
        }

        foreach ($list as $number) {
            $numberDivision = ($number < 0) ? $number+1 : $number-1;
            $key = ($number % $range == 0) ? $numberDivision/$range : $number/$range;
            $result[intval($key)][] = $number;
        }

        return $this->sort($result);
    }

    private function sort($list, $deepArray=false)
    {
        if (count( $list ) < 2 && !$deepArray) {
            return $list;
        }
        $left = [];
        $right = [];

        $pivot  = array_shift($list);
        $pivot_val = (is_array($pivot)) ? $pivot[0] : $pivot;

        foreach( $list as $key => $value ) {
            if (!is_int($value) && !is_array($value) || !is_int($pivot_val) && !is_array($pivot_val)) {
                throw new InvalidArgumentException();
            }

            $isArray = is_array($value);
            $value = $this->sort($value, $isArray);
            $currValue = ($isArray) ? $value[0] : $value;
            if ($currValue < $pivot_val) {
                $left[$key] = $value;
            } else {
                $right[$key] = $value;
            }
        }
        //var_dump($this->sort($left));
        return array_merge($this->sort($left), [$this->sort($pivot)], $this->sort($right));
    }

}
