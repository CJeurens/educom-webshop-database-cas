SELECT 
city_A.name AS city_A,
city_B.name AS city_B,
city_A.id AS city_A_id,
city_B.id AS city_B_id,
city_A.commune_ID AS commune_ID_A,
city_B.commune_ID AS commune_ID_B

FROM  mhl_cities AS city_A
LEFT JOIN mhl_cities AS city_B ON (city_A.name=city_B.name)
LEFT JOIN mhl_communes ON (mhl_communes.id=city_A.commune_ID)

WHERE city_A.id<city_B.id   /*remove duplicate entries*/

ORDER BY city_A.name;