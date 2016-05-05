define({ "api": [
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "/var/www/mysite.com/public_html/apidoc/main.js",
    "group": "_var_www_mysite_com_public_html_apidoc_main_js",
    "groupTitle": "_var_www_mysite_com_public_html_apidoc_main_js",
    "name": ""
  },
  {
    "type": "get",
    "url": "/memcached/:key",
    "title": "delete cache by key",
    "sampleRequest": [
      {
        "url": "http://mysite.com/memcached/users/90"
      }
    ],
    "name": "delete",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "key",
            "description": "<p>memcache key.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "200",
            "description": "<p>OK, Memcached viewer.</p>"
          }
        ]
      }
    },
    "description": "<p>delete cache by key.</p>",
    "version": "0.0.0",
    "filename": "/var/www/mysite.com/public_html/application/controllers/Cache.php",
    "group": "_var_www_mysite_com_public_html_application_controllers_Cache_php",
    "groupTitle": "_var_www_mysite_com_public_html_application_controllers_Cache_php"
  },
  {
    "type": "get",
    "url": "/memcached/",
    "title": "get list of keys stored in cache",
    "sampleRequest": [
      {
        "url": "http://mysite.com/memcached"
      }
    ],
    "name": "view",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "200",
            "description": "<p>OK, Memcached viewer.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>NotFound</p>"
          }
        ]
      }
    },
    "description": "<p>get list of keys stored in cache.</p>",
    "version": "0.0.0",
    "filename": "/var/www/mysite.com/public_html/application/controllers/Cache.php",
    "group": "_var_www_mysite_com_public_html_application_controllers_Cache_php",
    "groupTitle": "_var_www_mysite_com_public_html_application_controllers_Cache_php"
  },
  {
    "type": "post",
    "url": "/object_name/",
    "title": "add new object",
    "sampleRequest": [
      {
        "url": "http://mysite.com/users/"
      }
    ],
    "name": "add",
    "parameter": {
      "fields": {
        "User Parameters": [
          {
            "group": "User Parameters",
            "type": "String",
            "optional": false,
            "field": "role",
            "description": "<p>user role form a list (admin, photographer, client).</p>"
          },
          {
            "group": "User Parameters",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>user name.</p>"
          },
          {
            "group": "User Parameters",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>unique username.</p>"
          },
          {
            "group": "User Parameters",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>user password.</p>"
          },
          {
            "group": "User Parameters",
            "type": "Number",
            "optional": true,
            "field": "phone",
            "description": "<p>user phone.</p>"
          }
        ],
        "Album Parameters": [
          {
            "group": "Album Parameters",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>album name.</p>"
          },
          {
            "group": "Album Parameters",
            "type": "Number",
            "optional": false,
            "field": "user",
            "description": "<p>user id.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 201": [
          {
            "group": "Success 201",
            "type": "json",
            "optional": false,
            "field": "object",
            "description": "<p>all fields and values referred to an object.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 201 Created\n    {\n\t\t\"id\": \"12\",\n\t\t\"user\": \"88\",\n\t\t\"name\": \"test\",\n\t\t\"active\": \"1\",\n\t\t\"created_at\": \"2016-04-26 16:57:23\",\n\t\t\"modified_at\": null\n    }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400",
            "description": "<p>Empty Request</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>Not Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "406",
            "description": "<p>Not Passed Validation</p>"
          }
        ]
      }
    },
    "description": "<p>add new object.</p>",
    "version": "0.0.0",
    "filename": "/var/www/mysite.com/public_html/application/controllers/Main.php",
    "group": "_var_www_mysite_com_public_html_application_controllers_Main_php",
    "groupTitle": "_var_www_mysite_com_public_html_application_controllers_Main_php"
  },
  {
    "type": "delete",
    "url": "/object_name/:id",
    "title": "delete object by id",
    "sampleRequest": [
      {
        "url": "http://mysite.com/users/90"
      }
    ],
    "name": "delete",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>unique ID of an object.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 204": [
          {
            "group": "Success 204",
            "optional": false,
            "field": "204",
            "description": "<p>Deleted</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400",
            "description": "<p>Empty Request</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>Not Found</p>"
          }
        ]
      }
    },
    "description": "<p>delete object by id.</p>",
    "version": "0.0.0",
    "filename": "/var/www/mysite.com/public_html/application/controllers/Main.php",
    "group": "_var_www_mysite_com_public_html_application_controllers_Main_php",
    "groupTitle": "_var_www_mysite_com_public_html_application_controllers_Main_php"
  },
  {
    "type": "get",
    "url": "/object_name/:id",
    "title": "get full information about object",
    "sampleRequest": [
      {
        "url": "http://mysite.com/users/1"
      }
    ],
    "name": "get",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "id",
            "defaultValue": "NULL",
            "description": "<p>unique ID of an object.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "json",
            "optional": false,
            "field": "object",
            "description": "<p>all fields and values referred to an object.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\": \"1\",\n  \"role\": \"admin\",\n  \"name\": \"ann\",\n  \"username\": \"ann\",\n  \"password\": \"ann\",\n  \"token\": \"24cc65df753de47ba1352bd44883fa71c2751ba1d6d197c94a4378e26b695ce6\",\n  \"phone\": null,\n  \"modified_at\": null,\n  \"created_at\": \"2016-04-04 11:36:55\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>NotFound</p>"
          }
        ]
      }
    },
    "description": "<p>get object by id or group of objects if no id passed.</p>",
    "version": "0.0.0",
    "filename": "/var/www/mysite.com/public_html/application/controllers/Main.php",
    "group": "_var_www_mysite_com_public_html_application_controllers_Main_php",
    "groupTitle": "_var_www_mysite_com_public_html_application_controllers_Main_php"
  },
  {
    "type": "put",
    "url": "/object_name/:id",
    "title": "update object by id",
    "sampleRequest": [
      {
        "url": "http://mysite.com/users/1"
      }
    ],
    "name": "update",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>unique ID of an object.</p>"
          }
        ],
        "User Parameters": [
          {
            "group": "User Parameters",
            "type": "String",
            "optional": true,
            "field": "role",
            "description": "<p>user role form a list (admin, photographer, client).</p>"
          },
          {
            "group": "User Parameters",
            "type": "String",
            "optional": true,
            "field": "name",
            "description": "<p>user name.</p>"
          },
          {
            "group": "User Parameters",
            "type": "String",
            "optional": true,
            "field": "username",
            "description": "<p>unique username.</p>"
          },
          {
            "group": "User Parameters",
            "type": "String",
            "optional": true,
            "field": "password",
            "description": "<p>user password.</p>"
          },
          {
            "group": "User Parameters",
            "type": "Number",
            "optional": true,
            "field": "phone",
            "description": "<p>user phone.</p>"
          }
        ],
        "Album Parameters": [
          {
            "group": "Album Parameters",
            "type": "String",
            "optional": true,
            "field": "name",
            "description": "<p>album name.</p>"
          },
          {
            "group": "Album Parameters",
            "type": "Number",
            "optional": true,
            "field": "user",
            "description": "<p>user id.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 204": [
          {
            "group": "Success 204",
            "optional": false,
            "field": "204",
            "description": "<p>Created</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400",
            "description": "<p>Empty Request</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404",
            "description": "<p>Not Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "406",
            "description": "<p>Not Passed Validation</p>"
          }
        ]
      }
    },
    "description": "<p>update object by id.</p>",
    "version": "0.0.0",
    "filename": "/var/www/mysite.com/public_html/application/controllers/Main.php",
    "group": "_var_www_mysite_com_public_html_application_controllers_Main_php",
    "groupTitle": "_var_www_mysite_com_public_html_application_controllers_Main_php"
  }
] });
