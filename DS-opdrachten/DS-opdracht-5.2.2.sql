SELECT
mhl_cities.name AS city,
COUNT(IF (mhl_membertypes.name="Gold",1,NULL)) AS Gold,
COUNT(IF (mhl_membertypes.name="Silver",1,NULL)) AS Silver,
COUNT(IF (mhl_membertypes.name="Bronze",1,NULL)) AS Bronze,
COUNT(IF (mhl_membertypes.name NOT IN ("Gold","Silver","Bronze"),1,NULL)) AS Other

FROM mhl_membertypes

JOIN mhl_suppliers ON (mhl_suppliers.membertype=mhl_membertypes.id)
JOIN mhl_cities ON (mhl_suppliers.city_ID=mhl_cities.id)

GROUP BY city
ORDER BY Gold DESC;