// // Sample arrays of IDs and messages
// const ids = [1, 2, 3];
// const messages = [
//   "Message 1",
//   "Message 2",
//   "Message 3",
//   "Message 4",
//   "Message 5",
// ];

// // Initialize an index variable to keep track of the current ID to type
// let currentIndex = 0;

// // Loop through the messages array
// for (let i = 0; i < messages.length; i++) {
//   const message = messages[i];
//   const currentId = ids[currentIndex];

//   // Simulate typing the message with the corresponding ID
//   console.log(`Typing message "${message}" to ID ${currentId}`);

//   // Move to the next ID, and if we reach the end, start from the beginning
//   currentIndex = (currentIndex + 1) % ids.length;
// }
// Assuming you have two arrays, one with numbers and one with strings
// const numbers = [1.4, 2.7, 0.9, 4.8, "e", 5.5];
// const floorResult = [1, 2, 0, 4, 5];

// function throwError(element) {
//   if (element === "e") {
//     throw new Error("Erro Corupt element");
//   } else {
//     return Math.floor(element);
//   }
// }

// for (let i = 0; i < numbers.length; i++) {
//   try {
//     // Perform your function on the current element from the first array
//     if (numbers[i] === "e") {
//       throw new Error("Erro Corupt element");
//     } else {
//       console.log(Math.floor(numbers[i]));
//     }
//   } catch (error) {
//     // if (error.message.includes("division by zero")) {
//     //   console.log(`Error: Division by zero for ${numbers[i]}`);
//     // } else {
//     console.log(`An error occurred for ${numbers[i]}: ${error.message}`);
//     // }
//   }

//   // console.log(`String for ${numbers[i]} is ${floorResult[i]}`);
// }
