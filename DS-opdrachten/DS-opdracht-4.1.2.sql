SELECT mhl_suppliers.name,mhl_suppliers.straat,mhl_suppliers.huisnr,mhl_suppliers.postcode,mhl_cities.name 
FROM `mhl_cities` 
LEFT JOIN `mhl_communes` ON (mhl_cities.commune_ID=mhl_communes.id)
JOIN `mhl_suppliers` ON (mhl_suppliers.city_ID=mhl_cities.id)

WHERE mhl_communes.name LIKE "_teenwijkerland";