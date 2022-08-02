<?php

namespace html;

class html
{

    static function create_alertv5(string $message, string $type, bool $dissmissible = false, string $title = null)
    {
        if ($dissmissible) { ?>
            <div class="alert alert-<?php echo $type ?> alert-dismissible fade show" role="alert">
                <?php if ($title != null) { ?> <h4 class="alert-heading"><?php echo $title ?></h4> <?php } ?>
                <?php echo $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else { ?>
            <div class="alert alert-<?php echo $type ?>" role="alert">
                <?php if ($title != null) { ?> <h4 class="alert-heading"><?php echo $title ?></h4><?php } ?>
                <?php echo $message ?>
            </div>
        <?php
        }
    }

    static function create_alertv4(string $message, string $type, bool $dissmissible = false, string $title = null)
    {
        if ($dissmissible) { ?>
            <div class="alert alert-<?php echo $type ?> alert-dismissible fade show" role="alert">
                <?php if ($title != null) { ?> <h4 class="alert-heading"><?php echo $title ?></h4> <?php } ?>
                <?php echo $message ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } else { ?>
            <div class="alert alert-<?php echo $type ?>" role="alert">
                <?php if ($title != null) { ?> <h4 class="alert-heading"><?php echo $title ?></h4><?php } ?>
                <?php echo $message ?>
            </div>
<?php
        }
    }

    private function combine_properties(array $params, array $values)
    {
        $array = array_combine($params, $values);
        $properties = "";
        foreach ($array as $key => $value) {
            $properties .= " $key='$value' ";
        }
        return $properties;
    }

    static function form_input($name,  $type, $class = null, $value = null, $placeholder = null)
    {
        echo "<input name='$name' id='$name' class='form-control $class ' type='$type' value='$value' placeholder='$placeholder' >";
    }

    // static function input(array $params, array $values)
    // {
    //     $properties = self::combine_properties($params, $values);
    //     echo "<input $properties >";
    // }

    static function button(array $params, array $values, string $text)
    {
        $properties = self::combine_properties($params, $values);
        echo "<button $properties >$text</button>";
    }

    static function label(array $params, array $values, string $text)
    {
        $properties = self::combine_properties($params, $values);
        echo " <label $properties>$text</label>";
    }
}
