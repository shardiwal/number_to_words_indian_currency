# Indian currency - Number to Words converter

Its a small utility to convert currency number to words format

### Version
1.0

### Methods
* toWords - print given amount in words
* toCurrency - print given amount in currency format

### Example
```php
$converter = new toIndianCurrency();
echo $converter->toWords('12');
// Twelve Rs. only

echo $converter->toWords('123');
// One Hundred and Twenty-Three Rs. only

echo $converter->toWords('1234');
// One Thousand Two Hundred and Thirty-Four Rs. only

echo $converter->toWords('12345');
// Twelve Thousand Three Hundred and Fourty-Five Rs. only

echo $converter->toWords('123456');
// One Lakh Twenty-Three Thousand Four Hundred and Fifty-Six Rs. only

echo $converter->toWords('12345600');
// One Crore Twenty-Three Lakh Fourty-Five Thousand Six Hundred Rs. only
```

#### Currency symbol can be changed like this
```php
$converter = new toIndianCurrency();
$converter->currency = '₹';
echo $converter->toWords('12');
// Twelve ₹ only
```

#### Postfix text can be changed like this
```php
$converter = new toIndianCurrency();
$converter->postfix = 'payable';
echo $converter->toWords('12');
// Twelve ₹ payable
```

#### Postfix text and currency can be disabled like this
```php
$converter = new toIndianCurrency();
echo $converter->toWords('12','no_postfixtext');
// Twelve
```

### Todo's

 - Write Tests
 - Add Internationalization 
 - Add Code Comments

License
----

MIT

**Free Software, Yeah!**

[Rakesh Kumar Shardiwal]:http://github.com/shardiwal

