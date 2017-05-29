import pymysql
db = pymysql.connect(host='10.0.0.140',user='root',passwd='password')
cursor = db.cursor()
query = ("SHOW DATABASES")
cursor.execute(query)
for r in cursor:
    print r
