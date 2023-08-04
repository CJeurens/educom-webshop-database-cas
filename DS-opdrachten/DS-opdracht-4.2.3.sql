SELECT 
sub.id,
IFNULL(hoofd.name,sub.name) AS hoofdrubriek,
IF(ISNULL(hoofd.name),'',sub.name) AS subrubriek

FROM
mhl_rubrieken AS hoofd
RIGHT JOIN mhl_rubrieken AS sub ON (sub.parent=hoofd.id)

ORDER BY hoofdrubriek,subrubriek;