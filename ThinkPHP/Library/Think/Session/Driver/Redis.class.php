<?php
namespace Think\Session\Driver;

/**
 * Class Redis  Session Redis驱动 使用 comomon中的 RC()获取redis对象
 *
 * @package Think\Session\Driver
 */
class Redis {
  protected $lifeTime     = 10800;//3小时
  protected $sessionName  = '';
    /**
     * @var \Redis
     */
  protected $handle       = null;

    /**
     * 打开Session 
     * @access public 
     * @param string $savePath 
     * @param mixed $sessName  
     */
  public function open($savePath, $sessName) {
      $this->lifeTime     = C('SESSION_EXPIRE') ? C('SESSION_EXPIRE') : $this->lifeTime;

    $this->handle       = RC();//

    return true;
  }

    /**
     * 关闭Session 
     * @access public 
     */
  public function close() {
    $this->gc(ini_get('session.gc_maxlifetime'));
    $this->handle->close();
    $this->handle       = null;
    return true;
  }

    /**
     * 读取Session 
     * @access public 
     * @param string $sessID 
     */
  public function read($sessID) {
        //每次读取session重新设置时间
        $this->handle->expire($this->sessionName.$sessID, $this->lifeTime);

        return $this->handle->get($this->sessionName.$sessID);
  }

    /**
     * 写入Session 
     * @access public 
     * @param string $sessID 
     * @param String $sessData  
     */
  public function write($sessID, $sessData) {

      $flag = $this->handle->setex($this->sessionName.$sessID, $this->lifeTime,$sessData);
      return $flag;

  }

    /**
     * 删除Session 
     * @access public 
     * @param string $sessID 
     */
  public function destroy($sessID) {
    return $this->handle->delete($this->sessionName.$sessID);
  }

    /**
     * Session 垃圾回收
     * @access public 
     * @param string $sessMaxLifeTime 
     */
  public function gc($sessMaxLifeTime) {
    return true;
  }
}
