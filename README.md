#aefw

## Database
select 
```
array DB::query(string $query, [string $types], [... mixed $parameters]);

returns the result array  
```


```
DB::query('SELECT * FROM table_name');
DB::query('SELECT * FROM table_name WHERE col = ?', 's', $stringColValue);
```

insert / update
```
int DB::modify(string $query, [string $types], [... mixed $parameters]);

returns the insert_id  
```


```
DB::modify('INSERT INTO table_name (col1) VALUES(?)', 's', $stringColValue);
DB::modify('INSERT INTO table_name (col1, col2) VALUES(?, ?)', 'si', $stringColValue, $intColValue);
```
