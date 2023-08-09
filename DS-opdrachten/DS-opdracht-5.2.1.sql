/*
IFNULL checkt alleen voor NULL waardes (geen match bij JOIN) en niet voor lege velden
tevens kan <>"" niet checken op NULL waardes
*/

SELECT
mhl_suppliers.name AS leverancier,
IFNULL(mhl_contacts.name,"t.a.v. de directie") AS aanhef, 
IF (mhl_suppliers.p_address<>"",mhl_suppliers.p_address,CONCAT(mhl_suppliers.straat," ",mhl_suppliers.huisnr)) AS adres,
IF (mhl_suppliers.p_address<>"",mhl_suppliers.p_postcode,mhl_suppliers.postcode) AS postcode,
IF (mhl_suppliers.p_address<>"",p_city.name,city.name) AS plaatsnaam,
IF (mhl_suppliers.p_address<>"",p_district.name,district.name) AS provincie

FROM mhl_suppliers
LEFT JOIN mhl_cities AS p_city ON (mhl_suppliers.p_city_ID=p_city.id)
LEFT JOIN mhl_cities AS city ON (mhl_suppliers.city_ID=city.id)
LEFT JOIN mhl_communes AS p_commune ON (p_city.commune_ID=p_commune.id)
LEFT JOIN mhl_communes AS commune ON (city.commune_ID=commune.id)
LEFT JOIN mhl_districts AS p_district ON (p_commune.district_ID=p_district.id)
LEFT JOIN mhl_districts AS district ON (commune.district_ID=district.id)
LEFT JOIN mhl_contacts ON (mhl_contacts.supplier_ID=mhl_suppliers.id)

ORDER BY provincie,plaatsnaam,leverancier;