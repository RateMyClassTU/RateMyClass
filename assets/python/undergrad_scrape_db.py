#!/home/TU/shi/anaconda3/bin/python
import re
from bs4 import BeautifulSoup as bs
import requests
import json
import pymysql 

conn = pymysql.connect(host="cis-linux2.temple.edu", user="tuh04803", password="eebiungo", db="FA20_3296_tuh04803") 
cur = conn.cursor() 
cur.execute("Truncate table BulletinUndergrad") 
conn.commit() 

data = {} #for undergrad courses
r = requests.get("https://bulletin.temple.edu/undergraduate/schools-colleges/")
soup = bs(r.content, features="lxml")


contents = soup.select("div#textcontainer a[href]")
count = 0

#Departments
for i in contents:
    c_link = "https://bulletin.temple.edu"+i["href"]
    A_str = contents[count].string
    A_str = A_str.replace(u'\u200b', u'')
    A_str = A_str.replace(u'\xfc', u'')
    data[A_str]=[]


    r = requests.get(c_link)
    soup = bs(r.content, features="lxml")
    links = soup.select("div#cl-menu li.active li.active li.active.self ul li a[href]")
    count2 =0
    
    #Subjects
    for j in links:
        temp = links[count2].string
        temp = temp.replace(u'\u200b', u'')
        temp = temp.replace(u'\xfc', u'')
        F = {temp:[]}
        

        #GET COURSES
        r = requests.get("https://bulletin.temple.edu"+j["href"])
        soup = bs(r.content, features="lxml")


        course_blocks = soup.select("div.courseblock")

        count3 = 0
        for x in course_blocks:
            k = soup.select("div.courseblock p.courseblocktitle") #name
            l = soup.select("div.courseblock div.courseblockheaddiv") #desc
            name = k[count3].string
            name = name.replace(u'\xa0', u' ')
            name = name.replace(u'\u200b', u'')
            name = name.replace(u'\xfc', u'')
            temp2 = {name:l[count3].string}
            F[temp].append(temp2.copy())

            cur.execute(("INSERT INTO BulletinUndergrad "
                        "(College,Department,Course,Description) "
                        "VALUES (%s,%s,%s,%s)"), (str(A_str),str(temp),str(name),str(l[count3].string)) )
            conn.commit() 

            count3 = count3+1
        
        print("\tDepartment: "+temp+" has been added\n")
        count2 = count2+1
        data[A_str].append(F)

    print("College: "+A_str+" has been added\n")
    count = count+1

print("Undergraduate Courses Successfully Added! Now please remove duplicates!")
conn.close
cur.close





















#JSON FILE FORMAT
# {
#     "college1":[  
#         {"major1":[
#             {"course1name":"course1desc"},
#             {"course2name":"course2desc"}
#         ]},
#         {"major2":[
#             {"course1name":"course1desc"},
#             {"course2name":"course2desc"}
#         ]}
#     ],
#     "college2":[
#         {"major1":[
#             {"course1name":"course1desc"},
#             {"course2name":"course2desc"}
#         ]},
#         {"major2":[
#             {"course1name":"course1desc"},
#             {"course2name":"course2desc"}
#         ]}
#     ]

# }

#ALTERNATIVE TO CLEANING HTMLL IMPORTED STRING OF WIERD CHARACTERS
# import lxml.html
# import lxml.html.clean
# html = "ARTE\xa03202"
# doc = lxml.html.fromstring(html)
# cleaner = lxml.html.clean.Cleaner(style=True)
# doc = cleaner.clean_html(doc)
# text = doc.text_content()
# print(text)