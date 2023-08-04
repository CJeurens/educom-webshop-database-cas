SELECT 
city_A.name AS city_A,
city_B.name AS city_B,
commune_A.name AS commune_A,
commune_B.name AS commune_B,
city_A.id AS city_A_id,
city_B.id AS city_B_id,
commune_A.id AS commune_A_id,
commune_B.id AS commune_B_id

FROM  mhl_cities AS city_A
JOIN mhl_cities AS city_B ON (city_A.name=city_B.name)
JOIN mhl_communes AS commune_A ON (commune_A.id=city_A.commune_ID)
JOIN mhl_communes AS commune_B ON (commune_B.id=city_B.commune_ID)

WHERE city_A.id<city_B.id       /*remove duplicate entries*/

ORDER BY city_A.name;