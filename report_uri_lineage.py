#!/usr/bin/python
# -*- coding: utf-8 -*-

import os, pandas as pd, mysql.connector,itertools, json


connection = mysql.connector.connect(host='localhost',
                                         database='sas',
                                         user='IR',
                                         password='pwd')



df= pd.read_csv('/home/lineage/Incoming/report_members.txt',names=['folder','id','name','type','description','uri'], delimiter=',')

df['begin_url']='https://saswcu.wcupa.edu/SASReportViewer/?reportUri='

df['end_url']='&page=vi6'

#print(df)

df['url']= df['begin_url'] + df['uri'] + df['end_url']

df['folder']=df.folder.str.strip('/')

#df2=pd.DataFrame(df)

#print(df2)

dash= df.loc[:,['folder','name','url']].values.tolist()

dash_df= df.loc[:,['folder','name','url']]

#dash_url= df.loc[:,['url']].values.tolist()

#dash= dash_ins+dash_url

#dash=str(dash)
#dash=json.dumps(dash)
#for item in itertools.chain(dash_ins ,dash_url):
#	print(item)

#print(dash_df['name'])

#dash_df= df[['folder','name','url']]

dash_insert_sql= """insert into dashboards (category 
                                           ,name
                                           ,URL
                                           ) values (%s,%s,%s)
					    ON DUPLICATE KEY UPDATE URL= values(URL) ;"""
#cursor = connection.cursor(buffered=True)

cursor = connection.cursor()

#cursor.execute('truncate table sas.dashboards ;')
#cursor.execute('select * from sas.dashboards;')

#existing= cursor.fetchall()
#for row in existing:
#	print(row[2])

cursor.executemany(dash_insert_sql, dash)

#for item in dash:
#	cursor.execute(dash_insert_sql, dash)

connection.commit()
connection.close()


