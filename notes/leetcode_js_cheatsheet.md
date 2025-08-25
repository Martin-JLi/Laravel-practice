# 🚀 LeetCode Algorithm Cheat Sheet (JavaScript)

## 🔹 Array Methods
```js
let arr = [1,2,3,4,5];

arr.push(6);        // Add to end
arr.pop();          // Remove from end
arr.shift();        // Remove from start
arr.unshift(0);     // Add to start
arr.slice(1,3);     // Copy [index 1 to 2]
arr.splice(2,1);    // Remove at index 2
arr.includes(3);    // true
arr.indexOf(4);     // 3
arr.join('-');      // "1-2-3-4-5"
```

## 🔹 String Methods
```js
let s = "leetcode";

s.split('');              // ['l','e','e','t'...]
s.substring(0,4);         // "leet"
s.toUpperCase();          // "LEETCODE"
s.toLowerCase();          // "leetcode"
s.indexOf('code');        // 4
s.includes('leet');       // true
s.replace('leet','code'); // "codecode"
```

## 🔹 HashMap & Set
```js
// Map
let map = new Map();
map.set('a', 1);
map.get('a');        // 1
map.has('a');        // true
map.delete('a');

// Set
let set = new Set([1,2,2,3]);
set.add(4);
set.has(2);          // true
set.delete(3);
```

## 🔹 Common Patterns

### 1. Two Pointers
```js
function twoSumSorted(nums, target) {
  let l = 0, r = nums.length - 1;
  while (l < r) {
    let sum = nums[l] + nums[r];
    if (sum === target) return [l, r];
    sum < target ? l++ : r--;
  }
}
```

### 2. Sliding Window
```js
function maxSubArray(nums, k) {
  let sum = 0, max = -Infinity;
  for (let i = 0; i < nums.length; i++) {
    sum += nums[i];
    if (i >= k - 1) {
      max = Math.max(max, sum);
      sum -= nums[i - (k - 1)];
    }
  }
  return max;
}
```

### 3. HashMap for Frequency
```js
function freqCounter(arr) {
  let freq = {};
  for (let num of arr) {
    freq[num] = (freq[num] || 0) + 1;
  }
  return freq;
}
```

### 4. Stack (Valid Parentheses)
```js
function isValid(s) {
  let stack = [], map = {')':'(', ']':'[', '}':'{'};
  for (let c of s) {
    if (c in map) {
      if (stack.pop() !== map[c]) return false;
    } else stack.push(c);
  }
  return stack.length === 0;
}
```

## 🔹 Edge Cases to Always Check
- Empty input (`[]`, `""`)  
- Single element input  
- Negative numbers / large numbers  
- Duplicates in arrays  
- Off-by-one in loops  
