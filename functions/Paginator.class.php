<?php

class Paginator {

    private $_limit;
    private $_page;
    private $_total;

    public function __construct( $page, $limit, $total ) {
        $this->_page = $page;
        $this->_limit = $limit;
        $this->_total = $total;
    }

    public function createLinks( $links, $list_class, $params = array() ) {
        if ( $this->_limit == 'all' ) {
            return '';
        }

        $url = "?";
        foreach($params as $key => $param)
        {
            $url .= "$key=$param&";
        }

        $last       = ceil( $this->_total / $this->_limit );

        $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
        $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;

        $html       = '<ul class="' . $list_class . '">';

        if( $this->_page == 1 ) {
            $html   .= '<li class="disabled"><span>&laquo;</span></li>';
        } else {
            $html   .= '<li><a href="'. $url .'limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . '">&laquo;</a></li>';
        }


        if ( $start > 1 ) {
            $html   .= '<li><a href="'. $url .'limit=' . $this->_limit . '&page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }

        for ( $i = $start ; $i <= $end; $i++ ) {
            if( $this->_page == $i ) {
                $html   .= '<li class="current"><span>' . $i . '</span></li>';
            } else {
                $html   .= '<li><a href="'. $url .'limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
            }
        }

        if ( $end < $last ) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li><a href="'. $url .'limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
        }

        if( $this->_page == $last ) {
            $html   .= '<li class="disabled"><span>&raquo;</span></li>';
        } else {
            $html   .= '<li><a href="'. $url .'limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . '">&raquo;</a></li>';
        }


        $html       .= '</ul>';

        return $html;
    }

}