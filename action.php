<?php
/**
 * Layout Switcher Plugin: switch laytout for Mobile
 *
 * Usage:
 *   1. Remove meta header for viewport from template files.
 *   2. Add the 'button' element on some wiki pages.
 *     <html>
 *       <button class="elm-to-switch-layout">レイアウト変更 for Mobile</button>
 *     </html>
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     laboradian <laboradian@gmail.com>
 */
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'action.php';

/**
 * Class action_plugin_layoutswitcher
 */
class action_plugin_layoutswitcher extends DokuWiki_Action_Plugin {

    // 利用する Cookie の名前
    private $cookieName = 'useDeviceWidth';

    /**
     * plugin should use this method to register its handlers with the DokuWiki's event controller
     *
     * @param    $controller   DokuWiki's event controller object. Also available as global $EVENT_HANDLER
     * @return   not required
     */
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook(
            'TPL_METAHEADER_OUTPUT', 'BEFORE',
            $this, '_metaAddViewpoint');
    }

    /**
     * Add the meta tag for viewpoint
     *
     * @param    $param   (mixed)   the parameters passed to register_hook when this handler was registered
     * @param    $event   (object)  event object by reference
     *
     * @return   not required
     */
    public function _metaAddViewpoint(&$event, $param) {
        if (! isset($_COOKIE[$this->cookieName])) {
            setcookie($this->cookieName, '1');
            $_COOKIE[$this->cookieName] = '1';
        }

        if ($_COOKIE[$this->cookieName] === '1') {
            $event->data["meta"][] = array (
                  "name" => "viewport",
                  "content" => "width=device-width,initial-scale=1",
            );
        }
    }

    public function getInfo(){
      return array(
        'author' => 'laboradian',
        'email'  => 'laboradian@gmail.com',
        'date'   => '2018-11-20',
        'name'   => 'Laytout Switcher plugin',
        'desc'   => 'Enable to switch layout for Mobile',
        'url'    => 'https://laboradian.com/',
      );
    }

}
