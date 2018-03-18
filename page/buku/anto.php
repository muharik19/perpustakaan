 $tahun = date('Y');

                            for ($i = $tahun-29; $i <= $tahun; $i++) {
                              if ($i==$data['TahunTerbit']) {     
                              echo "<option value='$i' selected>$data[TahunTerbit]</option>";
                            }
                            else {
                               echo "<option value='$i'>$i</option>";
                            }