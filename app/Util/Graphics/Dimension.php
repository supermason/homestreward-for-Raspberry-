<?php
/**
 * Created by PhpStorm.
 * User: mason.ding
 * Date: 2015/12/2
 * Time: 10:59
 */

namespace App\Util\Graphics;

/**
 * 一个维度类，可以定义一个坐标点（x, y）和一个范围(w, h)
 *
 * Class Dimension
 * @package app\Util
 */
class Dimension
{
    private $_x;
    private $_y;
    private $_w;
    private $_h;

    /**
     * 构造方法
     *
     * @param int $x
     * @param int $y
     * @param int $w
     * @param int $h
     */
    function __construct($x=0, $y=0, $w=300, $h=230)
    {
        $this->setX($x);
        $this->setY($y);
        $this->setW($w);
        $this->setH($h);
    }

    // logic
    public static function geometgricZoomTo($img, $destW, $destH)
    {

    }

    // getters && setters

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->_x;
    }

    /**
     * @param mixed $x
     * @return Dimension
     */
    public function setX($x)
    {
        $this->_x = abs($x);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->_y;
    }

    /**
     * @param mixed $y
     * @return Dimension
     */
    public function setY($y)
    {
        $this->_y = abs($y);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getW()
    {
        return $this->_w;
    }

    /**
     * @param mixed $w
     * @return Dimension
     */
    public function setW($w)
    {
        $this->_w = abs($w);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getH()
    {
        return $this->_h;
    }

    /**
     * @param mixed $h
     * @return Dimension
     */
    public function setH($h)
    {
        $this->_h = abs($h);
        return $this;
    }
}