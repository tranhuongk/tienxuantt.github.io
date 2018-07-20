tóm tắt kiến thức hướng đối tượng php
- các thuộc tính và phương thức là public thì được truy cập mọi nơi, 
protected thì chỉ nó và con nó được truy cập, private thì chỉ nó được truy cập.
- khi kế thừa thì tất cả các thuộc tính và phương thức của lớp cha đều là của lớp con, 
có những phương thức của lớp cha là private thì lớp con không được truy cập, tuy nhiên nó vẫn có quyền sở hữu.
- có thể dùng từ khóa this đối với tất cả các thuộc tính và phương thức của nó và cha nó nếu như được phép.
- nếu thuộc tính là static thì bắt buộc phải dùng dấu 4 chấm thì mới truy cập được, có thể dùng tên lớp
hoặc tên đối tượng hoặc this để truy cập nó. 
- nếu phương thức là static thì có thể dùng cả mũi tên và 4 dấu chấm để truy cập nó
- dùng self để gọi các thuộc tính và phương thức của nó, dùng parent để gọi các thuộc tính và phương thức của cha nó. 
có thể ko cần dùng hai cái đõ cũng được, chỉ cần dùng this .
 - const giống như static , dùng 4 chấm để truy cập 
 - phương thức static thì chỉ được phép gọi tới các thuộc tính static
 - khi dùng parent và self thì phải dùng 4 chấm
 - final class thì không cho phép kế thừa, final phương thức thì không cho phép override lại phương thức đó
 - abstract class có thể có các phương thức được định nghĩa và các phương thức ko có định nghĩa,
  đó là các phương thức abstract
 - interface thì chỉ chứa các thuộc tính và phương thức abstract, nghĩa là ko có ngoặc {} 
 - khi các lớp con kế thừa các lớp abstract và interface thì phải override lại các phương thức abstract