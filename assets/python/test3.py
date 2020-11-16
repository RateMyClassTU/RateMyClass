#TEST FOR CREATING SAMPLE JSON FILE FROM PYTHON DATA
import json

data = {
    "college1":[  
        {"major1":[
            {"course1name":"course1desc"},
            {"course2name":"course2desc"}
        ]},
        {"major2":[
            {"course1name":"course1desc"},
            {"course2name":"course2desc"}
        ]}
    ],
    "college2":[
        {"major1":[
            {"course1name":"course1desc"},
            {"course2name":"course2desc"}
        ]},
        {"major2":[
            {"course1name":"course1desc"},
            {"course2name":"course2desc"}
        ]}
    ]

}

with open('data.json', 'w') as outfile:
    json.dump(data, outfile, indent=4,sort_keys=True)

