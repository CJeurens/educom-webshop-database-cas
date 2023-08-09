SELECT
mhl_hitcount.year AS jaar,
SUM(IF(mhl_hitcount.month<=3,mhl_hitcount.hitcount,0)) AS 1e_kwartaal,
SUM(IF(mhl_hitcount.month>=4 AND mhl_hitcount.month<=6,mhl_hitcount.hitcount,0)) AS 2e_kwartaal,
SUM(IF(mhl_hitcount.month>=7 AND mhl_hitcount.month<=9,mhl_hitcount.hitcount,0)) AS 3e_kwartaal,
SUM(IF(mhl_hitcount.month>=10,mhl_hitcount.hitcount,0)) AS 4e_kwartaal,
SUM(mhl_hitcount.hitcount) AS totaal

FROM mhl_hitcount
GROUP BY year;