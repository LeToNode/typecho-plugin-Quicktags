<?php
/**
 * 集成Quicktags编辑器,
 * 使用前请先禁用TinyMCE插件.
 * 
 * @package Quicktags Editor 
 * @author leton
 * @version 1.0.2
 * @link http://www.letonlife.com
 */
class Quicktags_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('admin/write-post.php')->richEditor = array('Quicktags_Plugin', 'render');
        Typecho_Plugin::factory('admin/write-page.php')->richEditor = array('Quicktags_Plugin', 'render');
        
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
    }
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function render($post)
    {
        $options = Helper::options();
        $js = Typecho_Common::url('Quicktags/qt/quicktags-min.js', $options->pluginUrl);
        echo "<script type=\"text/javascript\" src=\"{$js}\"></script>
<script type=\"text/javascript\">
    var qteditor = new QTags(\"qteditor\",\"text\",\"text\",\"\");
    /** 这两个函数在插件中必须实现 */
    var insertImageToEditor = function (title, url, link) {
        edInsertContent(qteditor.Canvas, '<a href=\"' + link + '\" title=\"' + title + '\"><img src=\"' + url + '\" alt=\"' + title + '\" /></a>');
        new Fx.Scroll(window).toElement($(document).getElement('textarea#text'));
    };
    
    var insertLinkToEditor = function (title, url, link) {
    		edInsertContent(qteditor.Canvas, '<a href=\"' + url + '\" title=\"' + title + '\">' + title + '</a>');
        new Fx.Scroll(window).toElement($(document).getElement('textarea#text'));
    };
</script>";
    }
}
