<?php 

class Segments_SegmentOriginalDataDao extends DataAccess_AbstractDao {

    /**
     * @param int $id_segment
     * @param int $ttl
     *
     * @return DataAccess_IDaoStruct
     */
    public static function getBySegmentId( $id_segment, $ttl = 86400 ) {

        $thisDao = new self();
        $conn = $thisDao->getDatabaseHandler();
        $stmt = $conn->getConnection()->prepare( "SELECT * FROM segment_original_data WHERE id_segment = ? " );

        return $thisDao->setCacheTTL( $ttl )->_fetchObject( $stmt,
                new Segments_SegmentOriginalDataStruct(),
                [ $id_segment ]
        )[0];
    }

    /**
     * @param     $id_segment
     * @param int $ttl
     *
     * @return array
     */
    public static function getSegmentDataRefMap( $id_segment, $ttl = 86400 ) {
        $dataRefMap = self::getBySegmentId($id_segment, $ttl);

        if(empty($dataRefMap)){
            return [];
        }

        $dataRefMapArray = json_decode($dataRefMap->map, true);

        return (!empty($dataRefMapArray)) ? $dataRefMapArray : [];
    }

    /**
     * @param int $id_segment
     * @param array $map
     */
    public static function insertRecord( $id_segment, array $map ) {
        $conn = Database::obtain()->getConnection();
        $stmt = $conn->prepare( "INSERT INTO segment_original_data " .
            " ( id_segment, map  ) VALUES " .
            " ( :id_segment, :map ) "
        );

        $json = json_encode($map);

        $stmt->execute( [
                'id_segment' => $id_segment,
                'map' => $json
        ] );
    }
}

