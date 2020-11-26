#!/home/TU/shi/anaconda3/bin/python
import re 
from bs4 import BeautifulSoup as bs 
import requests 
import json 
import pymysql

conn = pymysql.connect(host="cis-linux2.temple.edu", user="tuh04803", password="eebiungo", db="FA20_3296_tuh04803") 
cur = conn.cursor() 
cur.execute("Truncate table BulletinGrad") 
conn.commit() 

#GET GRADUATE COURSES

data2 = {} #for grad courses 
r2 = requests.get("https://bulletin.temple.edu/graduate/scd/") 
soup2 = bs(r2.content, features="lxml") 
contents = soup2.select("div#cl-menu li.active.self ul li a[href]") 
count = 0
#Departments
for i in contents:
    link = "https://bulletin.temple.edu"+i["href"]
    _str = contents[count].string
    _str = _str.replace(u'\u200b', u'')
    _str = _str.replace(u'\xfc',u'_')


    r2 = requests.get(link)
    soup2 = bs(r2.content, features="lxml")
    contents2 = soup2.select("div#cl-menu li.active.self ul li a[href]")
    count2 =0
    data2[_str]=[]
    
    #Subjects
    for j in contents2:
        link = "https://bulletin.temple.edu"+j["href"]
        _str2 = contents2[count2].string
        _str2 = _str2.replace(u'\u200b', u'')  
        _str2 = _str2.replace(u'\xfc',u'_')

        temp = {_str2:[]}


        #GET COURSES
        r2 = requests.get(link)
        soup2 = bs(r2.content, features="lxml")
        
        course_blocks = soup2.select("div#content-col div#courseinventorycontainer div.courseblock")
        count3 = 0
        for x in course_blocks:
            k = soup2.select("div.courseblock p.courseblocktitle") #name
            l = soup2.select("div.courseblock div.courseblockheaddiv") #desc
            name = k[count3].string
            name = name.replace(u'\xa0', u' ')
            name = name.replace(u'\xfc',u' ')


            temp2 = {name:l[count3].string}
            temp[_str2].append(temp2.copy())

            cur.execute(("INSERT INTO BulletinGrad "
                        "(College,Department,Course,Description) "
                        "VALUES (%s,%s,%s,%s)"), (str(_str),str(_str2),str(name),str(l[count3].string)) )
            conn.commit() 

            count3 = count3+1

        print("\tDepartment: "+_str2+" has been added\n")
        count2 = count2+1
        data2[_str].append(temp)

    print("College: "+_str+" has been added\n")
    count = count+1 

print("Graduate Courses successfully added! Now please remove duplicates!")
conn.close
cur.close