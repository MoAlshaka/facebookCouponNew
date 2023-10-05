function delay(time) {
  const timeBySec = time * 1000;
  return new Promise(function (resolve) {
    setTimeout(resolve, timeBySec);
  });
}

function findValueByName(arrayOfObjects, targetObjectName) {
  const foundObject = arrayOfObjects.find(
    (obj) => obj.name === targetObjectName
  );

  if (foundObject) {
    return foundObject.value;
  } else {
    return 10; // Return null (or any other default value) if the object is not found
  }
}

module.exports = { delay, findValueByName };
