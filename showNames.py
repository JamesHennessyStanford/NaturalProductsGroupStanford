import pymysql
db = pymysql.connect(host='localhost',user='root',passwd='HiMommy12')
cursor = db.cursor()
query = ("SHOW DATABASES")
cursor.execute(query)
for r in cursor:
    print r
