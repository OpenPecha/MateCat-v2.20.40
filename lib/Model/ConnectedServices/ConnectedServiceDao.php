<?php


namespace ConnectedServices ;

use Database ;
use PDO ;

class ConnectedServiceDao extends \DataAccess_AbstractDao {

    const TABLE = 'connected_services' ;
    const GDRIVE_SERVICE = 'gdrive' ;

    protected static $primary_keys = array('id');
    protected static $auto_increment_fields = array('id');


    /**
     * @param \Users_UserStruct $user
     * @param $name
     *
     * @return \ConnectedServices\ConnectedServiceStruct[]
     *
     */
    public function findServiceByUserAndName( \Users_UserStruct $user, $name ) {
        $conn = $this->con->getConnection() ;

        $stmt = $conn->prepare(
            "SELECT * FROM connected_services WHERE " .
            " uid = :uid AND service = :service "
        );

        $stmt->setFetchMode( \PDO::FETCH_CLASS, 'ConnectedServices\ConnectedServiceStruct' );
        $stmt->execute(
            array( 'uid' => $user->uid, 'service' => $name )
        );

        return $stmt->fetchAll();
    }

    /**
     * @param \Users_UserStruct $user
     * @param $service
     * @param $email
     * @return mixed
     */
    public function findUserServicesByNameAndEmail( \Users_UserStruct $user, $service, $email ) {
        $stmt = $this->con->getConnection()->prepare(
            " SELECT * FROM connected_services WHERE " .
            " uid = :uid AND service = :service AND email = :email "
        );

        $stmt->setFetchMode( \PDO::FETCH_CLASS, 'ConnectedServices\ConnectedServiceStruct' );
        $stmt->execute( array(
            'uid' => $user->uid,
            'service' => $service,
            'email' => $email
        ));

        return $stmt->fetch();
    }

    protected function _buildResult($array_result)
    {
        // TODO: Implement _buildResult() method.
    }
}