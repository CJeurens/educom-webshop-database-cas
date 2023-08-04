SELECT
mhl_suppliers.name as supplier,
mhl_propertytypes.name as property,
mhl_cities.name as city,
IFNULL(mhl_yn_properties.content,"NOT SET") as value

FROM mhl_propertytypes

CROSS JOIN mhl_suppliers    /*every entry in table a is connected to every entry in table b*/
LEFT JOIN mhl_yn_properties ON (mhl_yn_properties.propertytype_ID=mhl_propertytypes.id AND mhl_yn_properties.supplier_ID=mhl_suppliers.id)
JOIN mhl_cities ON (mhl_cities.id=mhl_suppliers.city_ID)

WHERE 
mhl_propertytypes.proptype="A"
AND mhl_cities.name LIKE "%_msterdam%";