import pymysql
db = pymysql.connect(host='localhost',user='root',passwd='*')
cursor = db.cursor()
query = ("SHOW DATABASES")
cursor.execute(query)
for r in cursor:
    print r
