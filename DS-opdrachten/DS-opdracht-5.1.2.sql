SELECT
COUNT(mhl_hitcount.hitcount),
AVG(mhl_hitcount.hitcount),
MIN(mhl_hitcount.hitcount),
MAX(mhl_hitcount.hitcount),
SUM(mhl_hitcount.hitcount)

FROM mhl_hitcount

GROUP BY mhl_hitcount.year;