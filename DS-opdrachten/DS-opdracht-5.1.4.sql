SELECT
mhl_suppliers.name AS supplier,
SUM(mhl_hitcount.hitcount) AS total_hitcount,
COUNT(mhl_hitcount.month) AS number_of_months,
AVG(mhl_hitcount.hitcount) AS average_hitcount_per_month

FROM mhl_hitcount
JOIN mhl_suppliers ON (mhl_suppliers.id=mhl_hitcount.supplier_ID)

GROUP BY mhl_suppliers.name  
ORDER BY `total_hitcount` DESC;