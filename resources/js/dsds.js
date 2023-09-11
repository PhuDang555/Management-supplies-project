const array = [
    { 0: "one 1", 1: "red" },
    { 1: "two", 2: "blue" },
    { 0: "one2", 2: "green", 3: "pink" },
    { 0: "one 3", 1: "black" },
];

const arrayKeys = [];
const newArrays = [];

array.forEach((item) => {
    const keys = Object.keys(item);
    keys.forEach((key) => {
        if (arrayKeys.includes(key)) {
            return;
        } else {
            return arrayKeys.push(key);
        }
    });
});

arrayKeys.forEach((key) => {
    const obj = {
        name: key,
        data: [],
    };
    array.forEach((item) => {
        const keys = Object.keys(item);
        let value = null;
        keys.forEach((itemKey) => {
            if (key === itemKey) {
                value = item[itemKey];
            }
        });
        obj.data.push(value);
    });
    newArrays.push(obj);
});

console.log(arrayKeys);
console.log(newArrays);
