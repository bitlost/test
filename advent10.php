<?php
$input = "0
138
3
108
64
92
112
44
53
27
20
23
77
119
62
121
11
2
37
148
34
83
24
10
79
96
98
127
7
115
19
16
78
133
61
82
91
145
39
33
13
97
55
141
1
134
40
71
54
103
101
26
47
90
72
126
124
110
131
58
12
142
105
63
75
50
95
69
25
68
144
86
132
89
128
135
65
125
76
116
32
18
6
38
109
111
30
70
143
104
102
120
31
41
17";


$sample_input = "0
28
33
18
42
31
14
46
20
48
47
24
23
49
45
19
38
39
11
1
32
25
35
8
17
7
9
4
2
34
10
3";

$input = explode("\n", $input);
sort($input);
$jolts = new Jolts($input);

echo $jolts->combos();


class Jolts {

  var $input;

  function __construct($input) {
    $this->input = $input;
  }
  
  function getDifference() {
    $difference = array('1' => 1, '3' => 1);
    
    for($i=0; $i < (count($this->input) - 1); $i++) {
      $sum = $this->input[$i+1] - $this->input[$i]; 
      $difference[$sum]++;
      
    }
    
    return $difference[1] * $difference[3];
    
  }
  
  function combos() {
    
    $combos = array();
    $input_size = count($this->input);
    for($i=0; $i < ($input_size - 1); $i++) {
      $max = $this->input[$i] + 3;
      $connections = 0;
      
      switch ($input_size - ($i+1)) {
        default:
        case 3:
          $connections = $this->input[($i+3)] <= $max ? $connections+1 : $connections;
        case 2:
          $connections = $this->input[($i+2)] <= $max ? $connections+1 : $connections;
        case 1:          
          $connections = $this->input[($i+1)] <= $max ? $connections+1 : $connections;
        break;
      }
      $combos[] = $connections;
      
    }
    
    //add 1 to end
    $combos[] = 1;
    
  
    return $this->countCombos($combos);
    
  }
  
  private function countCombos($combos) {
    $total = 0;
    
    $combo_size = count($combos);
    
    //walk backwards
    for($c = ($combo_size -1); $c >= 0; $c--) {
      
      $tmp_total = 0;
      
      for ($i = 1; $i <= $combos[$c]; $i++) {
        $index = ($c + $i);
        
        $tmp_total += ($index == $combo_size) ? 1 : $combos[$index]; 
      }
      $combos[$c] = $tmp_total;
    }
    

    return $combos[0];
  }
 
  
}


?>
