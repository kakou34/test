function out = magicSquare(n)
if ischar(n)
  n = str2num(n);
end
out = magic(n);
csvwrite('result.csv', out);
end

