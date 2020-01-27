#!/usr/bin/python
# -*- coding: utf-8 -*-

import os, pandas as pd, MySQLdb as m, json

file=open('\\\\sasdatap01\\sasdata\\PRD\\DATA\\report_members.txt','r')

#a=[]



df= pd.read_csv('\\\\sasdatap01\\sasdata\\PRD\\DATA\\report_members.txt',names=['folder','id','name','type','description','uri'], delimiter=',')

#df.insert('begin_url','https://saswcu.wcupa.edu/SASReportViewer/?reportUri=')

#df.insert('end_url','&page=vi6')

df['begin_url']='https://saswcu.wcupa.edu/SASReportViewer/?reportUri='

df['end_url']='&page=vi6'

df['url']= df['begin_url']+ df['uri']+df['end_url']

df['folder']=df.folder.str.strip('/')

dash= df.loc[:,['folder','name','url']].values.tolist()

#dash= df.loc[:,['folder','name','url','url']]

#+df.uri.str+'&page=vi6'

#print(df['report_url'])
#a=[]
#a=pd.DataFrame(df.uri.str.split('/',3).tolist(),columns = ['c1','c2','c3','actual_uri'])
#print(a['actual_uri'])

#a2=[]

dash_insert_sql= ("""insert into dashboards (category 
                                           ,name
                                           ,URL
                                           ) values (%s,%s,%s)
                                           on duplicate key update URL = values(URL) """)

#print(df.head())

#for f in file.readlines():
#    a1=[]
#    a1=f.split(',')
#    a2.append(a1[0])
    #print(f)
#print(a2)


try:
    conn=m.connect(user='IR', password='IRMIS13',
                                 host='localhost',
                                 database='sas')
except:
    print('MySQL Connection Error')

cur=conn.cursor()

#dash=json.dumps(dash)

#print(len(dash))

#dash= []
#for _, row in df.iterrows():
#    dash.append((row['folder'], row['name'], row['url'], row['url']))

cur.executemany(dash_insert_sql, dash)

conn.commit()
conn.close()
