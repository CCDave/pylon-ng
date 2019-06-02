<?php
/**
 * @brief  实体父类，实体需要继承
 *
 *  class Aplle extends XEntity
 */
use pylon\impl\DaoFinderUtls ;
use pylon\impl\SimpleDaoFactory ;
use pylon\impl\SimpleQueryFactory ;
use pylon\impl\SimpleMapping ;
use pylon\impl\StdMapping ;
use pylon\impl\DaoImp ;
use pylon\impl\XID ;
use pylon\impl\NOXID;
use pylon\impl\DQLObj ;


class XEntity extends pylon\impl\XEntityBase
{
    public function upgrade()
    {
        $this->xid->upgrade();
    }

    /**
     * @brief  获得对象id
     *
     * @return
     */
    public function id()
    {
        return $this->xid->id;
    }

    /**
     * @brief 获得实体的版本号
     *
     * @return
     */
    public function ver()
    {
        return $this->xid->ver;
    }

    /**
     * @brief  hash store need,override  this fun in subclass;
     *
     * @return  string key; default is null;
     */
    public function hashStoreKey()
    {
        return null;
    }

    /**
     * @brief
     *
     * @return
     */
    public function createTime()
    {
        return $this->xid->createTime;
    }
    /**
     * @brief
     *
     * @return
     */
    public function updateTime()
    {
        return $this->xid->updateTime;
    }


    /**
     * @brief  通过此方法，将实体注册
     *
     * @param $entity
     *
     * @return
     */
    static public function regist($entity)
    {
        DBC::requireNotNull($entity);
        return  static::unitWork()->regAdd($entity);
    }

    static public function createIns($cls)
    {
        $obj = new $cls(XID::create(strtolower($cls))) ;
        static::regist($obj) ;
        return $obj;
    }
}


class NOXEntity extends pylon\impl\XEntityBase
{
    public function upgrade()
    {

    }

    /**
     * @brief  获得对象id
     *
     * @return
     */
    public function id()
    {
        return $this->xid->id;
    }

    /**
     * @brief 获得实体的版本号
     *
     * @return
     */
    public function ver()
    {

    }

    /**
     * @brief  hash store need,override  this fun in subclass;
     *
     * @return  string key; default is null;
     */
    public function hashStoreKey()
    {
        return null;
    }

    /**
     * @brief
     *
     * @return
     */
    public function createTime()
    {

    }
    /**
     * @brief
     *
     * @return
     */
    public function updateTime()
    {

    }


    /**
     * @brief  通过此方法，将实体注册
     *
     * @param $entity
     *
     * @return
     */
    static public function regist($entity)
    {
        DBC::requireNotNull($entity);
        return  static::unitWork()->regAdd($entity);
    }

    static public function createIns($cls)
    {
        $obj = new $cls(NOXID::create(strtolower($cls))) ;
        static::regist($obj) ;
        return $obj;
    }


    static public function loadEntity($cls,$array,$mappingStg,$clsmap=array())
    {
        $xid    = NOXID::load($array);
        $prop   = $mappingStg->buildEntityProp($array);
        $entity = new $cls($xid,$prop);
        return  static::unitWork()->regLoad($entity);
    }

    static public function loadEntity2($cls,$array,$oprop,$mappingStg,$clsName=array())
    {
        $xid    = NOXID::load($array);
        $prop   = $mappingStg->buildEntityProp($array);
        $prop->merge($oprop);
        $entity = new $cls($xid,$prop);
        return  static::unitWork()->regLoad($entity);
    }

}
