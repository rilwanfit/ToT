<?php declare(strict_types = 1);

namespace App;

class HighCharts
{
    public function installJquery()
    {
        return '<script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>';
    }

    public function installHighchart()
    {
        return '<script src="//code.highcharts.com/highcharts.js"></script>';
    }

    public function installExport()
    {
            return '<script src="//code.highcharts.com/modules/exporting.js"></script>';
    }

    public function install()
    {
        return $this->installJquery().$this->installHighchart().$this->installExport();
    }

    public function export($id, $array = [])
    {
        $array = json_encode($array);

        return '
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#'.$id.'").exportChart('.$array.');
                });
            </script>
        ';
    }

    public function display($id = "", $array = [])
    {
        $array = json_encode($array);

        $view = $this->installJquery();
        $view .= $this->installHighchart();
        $view .= $this->installExport();
        $view .= '
            <script type="text/javascript">
            $(document).ready(function(){
                $("#'.$id.'").highcharts('.$array.');
                $("#'.$id.'").highcharts().getSVG();
            });
            </script>
            <div id="'.$id.'" style="width:100%; height:400px;"></div>
        ';

        return $view;
    }
}