import MySQLdb as m

try:
    conn=m.connect(user='IR', password='IRMIS13',
                                 host='localhost',
                                 database='sas')
except:
    print('Error')

cur=conn.cursor()

query=
