<?php
// Credenciales DB
$host = '10.25.1.9';
$port = '5432';
$dbname = 'hera';
$user = 'hera';
$password = 'E4rtH,G0dn3s$';
// Conexión
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password") or die('connection failed');
if ( !$conn ) {
    die("Database connection failed.");
}
// Creando la consulta
// Obtenemos la ubicacion del usuario y sus aplicativos segun cargo asignado
// type_id IN (1,3) y distinct Donde vinculacion sea Empleado o Aprendiz Sena, para que no traiga aplicaciones duplicadas en casos donde la persona tenga doble vinculacion.
$query = "  SELECT
                -- p.document, t2.name, t1.name, t3.name, ap.id, ap.is_global, ap.is_active,
                DISTINCT(en.zone_code), en.costcenter_code, ap.name, ap.description, ap.url
            FROM person p
                INNER JOIN entailment en ON en.person_document = p.document
                INNER JOIN users us ON us.document = p.document
                INNER JOIN employment em ON em.person_document = p.document
                INNER JOIN territory t1 ON t1.code = en.costcenter_code
                INNER JOIN territory t2 ON t2.code = en.zone_code
                INNER JOIN territory t3 ON t3.code = em.employment_code
                INNER JOIN app_employment ae ON ae.employment_code = em.employment_code
                INNER JOIN application ap ON ap.id = ae.app_id
            WHERE us.username = '$loggedUserName'
            AND ap.is_active = true
                            AND en.type_id IN (1,3)
            AND NOT ap.id =
                    ANY(CASE
                        WHEN en.costcenter_code = '1080' THEN ARRAY[8,9,10,11,12,43,44,45,46]       -- Cartago  (1080, Area Administrativa): 7 Bnet, 33 Bnet Teso Cartago
                        WHEN en.costcenter_code = '1089' THEN ARRAY[7,9,10,11,12,33,34,43,45,46]    -- Cairo (1089): 8 Bnet, 44 Bnet Teso Cairo
                        WHEN en.costcenter_code = '1090' THEN ARRAY[7,8,10,11,12,33,34,43,44,46]    -- Dovio (1090): 9 Bnet, 45 Bnet Teso Dovio
                        WHEN en.costcenter_code = '1087' THEN ARRAY[7,8,9,11,12,33,34,44,45,46]             -- Argelia (1087): 10 Bnet, 43 Bnet Teso Argelia
                        WHEN en.costcenter_code = '1098' THEN ARRAY[7,8,9,10,12,33,34,43,44,45]             -- Versalles (1098): 11 Bnet, 46 Bnet Teso Versalles
                        WHEN en.zone_code IN ('1083','1956','1957') THEN ARRAY[7,8,9,10,11,33,43,44,45,46]  -- Sevilla y Caicedona (1956-1957), Zona Municipios (1083): 12 Bnet, 34 Bnet Teso Municipios
                    END)
            ORDER by ap.name";
// Ejecutando query
$result = pg_query($conn, $query);
// Validacion query
if( !$result )
{
    $e = pg_get_result( $conn );
    print htmlentities( $e[ 'message' ]);
    echo "Error en la consulta, por favor intente nuevamente si el caso persiste contacte al administrador.";
    exit;
}
pg_close( $conn );
?>