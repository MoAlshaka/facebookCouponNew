/// <reference path="../pb_data/types.d.ts" />
migrate((db) => {
  const collection = new Collection({
    "id": "qbbfpzddtydrp5p",
    "created": "2023-09-16 13:19:25.954Z",
    "updated": "2023-09-16 13:19:25.954Z",
    "name": "cookies",
    "type": "base",
    "system": false,
    "schema": [
      {
        "system": false,
        "id": "igz2ulcu",
        "name": "name",
        "type": "text",
        "required": false,
        "unique": false,
        "options": {
          "min": null,
          "max": null,
          "pattern": ""
        }
      },
      {
        "system": false,
        "id": "rnua4bkr",
        "name": "value",
        "type": "json",
        "required": false,
        "unique": false,
        "options": {}
      }
    ],
    "indexes": [],
    "listRule": "",
    "viewRule": "",
    "createRule": "",
    "updateRule": "",
    "deleteRule": "",
    "options": {}
  });

  return Dao(db).saveCollection(collection);
}, (db) => {
  const dao = new Dao(db);
  const collection = dao.findCollectionByNameOrId("qbbfpzddtydrp5p");

  return dao.deleteCollection(collection);
})
