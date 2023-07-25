SELECT mhl_suppliers.name,mhl_suppliers.straat,mhl_suppliers.huisnr,mhl_suppliers.postcode,mhl_cities.name 
FROM `mhl_suppliers` LEFT JOIN `mhl_cities` ON (mhl_suppliers.city_ID=mhl_cities.id)
WHERE mhl_cities.name LIKE "%_msterdam%";