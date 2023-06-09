<?php
/**
 * 易居CMS
 * ============================================================================
 * 版权所有 2018-2028 海南易而优科技有限公司，并保留所有权利。
 * 网站地址: http://www.ejucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 小虎哥 <1105415366@qq.com>
 * Date: 2018-4-3
 */

namespace think\paginator\driver;

use think\Paginator;

class Eyou extends Paginator
{

    /**
     * 首页按钮
     * @param string $text
     * @return string
     */
    protected function getFirstButton($text = "&laquo;")
    {

        if ($this->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url(1);

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 上一页按钮
     * @param string $text
     * @return string
     */
    protected function getPreviousButton($text = "&laquo;",$class = '')
    {

        if ($this->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url(
            $this->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text,$class);
    }

    /**
     * 末页按钮
     * @param string $text
     * @return string
     */
    protected function getLastButton($text = '&raquo;')
    {
        if (!$this->hasMore) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->lastPage);

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 下一页按钮
     * @param string $text
     * @return string
     */
    protected function getNextButton($text = '&raquo;',$class = '')
    {
        if (!$this->hasMore) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text,$class);
    }

    /**
     * 共N页 N条
     * @param string $text
     * @return string
     */
    protected function getTotalResult()
    {
        return sprintf(
            '共<strong>%s</strong>页 <strong>%s</strong>条',
            $this->lastPage,
            $this->total
        );
    }

    /**
     * 页码按钮
     * @param string $listsize 当前页对称两边的条数
     * @return string
     */
    protected function getLinks($listsize = 3)
    {
        if ($this->simple)
            return '';
        $html = '';
        $start = $this->currentPage - $listsize;
        $end = $this->currentPage + $listsize;
        if ($start < 3 && ($end + 2) > $this->lastPage){   //全部显示
            $slider = $this->getUrlRange(1, $this->lastPage);
        }else if($start < 3){  //前面全部,后面省略
            $slider = $this->getUrlRange(1,$end);
            $slider_end['...'] = $this->url($end+1);
            $slider_end[$this->lastPage] = $this->url($this->lastPage);
            $slider = $slider + $slider_end;

        }else if(($end + 2) > $this->lastPage){   //前面省略,后面全部
            $slider = $this->getUrlRange($start,$this->lastPage);
            $slider_start['1'] = $this->url(1);
            $slider_start['...'] = $this->url($start - 1);
            $slider = $slider_start + $slider;
        }else{      //前面省略,后面也省略
            $slider_start['1'] = $this->url(1);
            $slider_start['...'] = $this->url($start - 1);
            $slider = $this->getUrlRange($start,$end);
            $slider_end['... '] = $this->url($end+1);
            $slider_end[$this->lastPage] = $this->url($this->lastPage);
            $slider = $slider_start + $slider + $slider_end;
        }
        $html .= $this->getUrlLinks($slider);

        return $html;
    }
    protected function getLinks_old($listsize = 3)
    {
        if ($this->simple)
            return '';

        $block = [
            'first'  => null,
            'slider' => null,
            'last'   => null
        ];

        $side   = $listsize;
        $window = $side * 2;

        if ($this->lastPage < $window + 2) {
            $block['first'] = $this->getUrlRange(1, $this->lastPage);    //显示全部
        } elseif ($this->currentPage < ($side + 1)) {
            $block['first'] = $this->getUrlRange(1, $window + 1);
        } elseif ($this->currentPage > ($this->lastPage - $side)) {
            $block['last']  = $this->getUrlRange($this->lastPage - $window, $this->lastPage);
        } else {
            $block['slider'] = $this->getUrlRange($this->currentPage - $side, $this->currentPage + $side);
        }

        $html = '';

        if (is_array($block['first'])) {
            $html .= $this->getUrlLinks($block['first']);
        }

        if (is_array($block['slider'])) {
            $html .= $this->getUrlLinks($block['slider']);
        }

        if (is_array($block['last'])) {
            $html .= $this->getUrlLinks($block['last']);
        }

        return $html;
    }

    /**
     * 渲染分页html
     * @param string $listitem 分页格式显示
     * @param string $listsize 当前页对称两边的条数
     * @return mixed
     */
    public function render($listitem = '', $listsize = '')
    {
        if ($this->hasPages()) { // 有数据的情况下

            $listitemArr = explode(',', $listitem);
            foreach ($listitemArr as $key => $val) {
                $listitemArr[$key] = trim($val);
            }

            $pageArr = array();
            if (in_array('index', $listitemArr)) {
                array_push($pageArr, $this->getFirstButton('首页'));
            }
            if (in_array('pre', $listitemArr) && $this->currentPage() > 1) {
                array_push($pageArr, $this->getPreviousButton('上一页','pre'));
            }
            if (in_array('pageno', $listitemArr)) {
                array_push($pageArr, $this->getLinks($listsize));
            }
            if (in_array('next', $listitemArr) && $this->hasMore) {
                array_push($pageArr, $this->getNextButton('下一页','next'));
            }
            if (in_array('end', $listitemArr)) {
                array_push($pageArr, $this->getLastButton('末页'));
            }
            if (in_array('info', $listitemArr)) {
                array_push($pageArr, $this->getTotalResult());
            }
            $pageStr = implode(' ', $pageArr);

            return $pageStr;

        } else { // 没有数据的情况下
            return $this->getTotalResult();
        }
    }

    /**
     * 生成一个可点击的数字按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getAvailablePageWrapper2($url, $page,$class = '')
    {
        return '<li><a href="' . htmlentities($url) . '"  data-ey_fc35fdc="html" data-tmp="1' . '" class="tcdNumber '.$class.'">' . $page . '</a></li>';
    }

    /**
     * 生成一个可点击的按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page,$class = '')
    {
        return '<li><a href="' . htmlentities($url) . '" data-ey_fc35fdc="html" data-tmp="1' . '" class="tcdNumber '.$class.'">' . $page . '</a></li>';
    }

    /**
     * 生成一个禁用的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<li><span class="disabled">' . $text . '</span></li>';
    }

    /**
     * 生成一个激活的数字按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper2($text)
    {
        return '<li><span class="current">' . $text . '</span></li>';
    }

    /**
     * 生成一个激活的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li><span class="current">' . $text . '</span></li>';
    }

    /**
     * 生成省略号按钮
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper('···');
    }

    /**
     * 批量生成页码按钮.
     *
     * @param  array $urls
     * @return string
     */
    protected function getUrlLinks(array $urls)
    {
        $html = '';

        foreach ($urls as $page => $url) {
            $html .= $this->getPageLinkWrapper2($url, $page);
        }

        return $html;
    }

    /**
     * 生成普通页码按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getPageLinkWrapper($url, $page,$class = '')
    {
        if ($page == $this->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePageWrapper($url, $page,$class);
    }

    /**
     * 生成普通页码的数字按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getPageLinkWrapper2($url, $page)
    {
        if ($page == $this->currentPage()) {
            return $this->getActivePageWrapper2($page);
        }

        return $this->getAvailablePageWrapper2($url, $page);
    }
}
