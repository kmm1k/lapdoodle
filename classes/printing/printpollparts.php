<?php
namespace Lapdoodle;


class printing_printpollparts {

    public function __construct($poll, $isInPoll, $with_dates, $isAdmin) {
        ?>
        <div class="table-responsive">
        <form class="forms" action="" method="POST">
        <table class="poll-table table table-bordered">
            <?php
            $this->printOptions($poll, $isAdmin);
            $this->printUsers($poll, $isAdmin);
            if (!$isAdmin) {
                if (!$isInPoll) {
                    $this->printUser($poll);
                    ?>
                    <tr>
                        <td>
                            <?php
                            new printing_printaddtopollbutton();
                            ?>
                        </td>
                    </tr>
                <?php
                } else {
                    new printing_removefrompollbutton();
                }
            } else {
            ?>
            <tr>
                <td>
                    <?php
                new printing_printconfirmbutton();
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        </form>
        </div>
        <?php
        if ($isAdmin && ADMIN_CAN_ADD_PEOPLE === TRUE) {
            //new printing_printadminaddpersonform();
        }
    }

    function printOptions($poll, $isAdmin) {
        $options = unserialize($poll['custom']);
        $count = 0;
        ?>
            <tr>
                <th>
                    user
                </th>
                <?php
                foreach ($options as $option) {
                    if ($isAdmin) {
                        echo '<th><input type="text" name="option'.$count.'" value="'.$option.'"></th>';
                    } else {
                        echo '<th>'.$option.'</th>';
                    }
                    $count++;
                }
                if ($isAdmin) {
                    echo '<th><input type="text" name="option'.$count.'" value="" placeholder="add new"></th>';
                }
                ?>
            </tr>
        <?php
        return $count;
    }

    function printUsers($poll, $isAdmin) {
        $users = unserialize($poll['poll']);
        $options = unserialize($poll['custom']);
        $col = 0;
        foreach ($users as $user) {
            $col++;
            ?>
            <tr>
                <td>
                    <?php
                    if ($isAdmin) {
                        ?>
                        <input type="checkbox" name="user_<?php echo $col; ?>" value="<?php echo $user['email']; ?>">
                        <?php
                    }
                    echo $user['name'];
                    ?>
                </td>
                <?php
                $number = 0;
                foreach ($options as $option) {
                    echo '<td>';
                    if ($isAdmin) {
                        $number++;
                        if ($this->isPartOfOption($option, $user)) {
                            echo '<input type="checkbox" value="'.$option.'" name="usr_'.$col.'_'.$number.'" checked>';
                        } else {
                            echo '<input type="checkbox" value="'.$option.'" name="usr_'.$col.'_'.$number.'">';
                        }
                    } else {
                        if ($this->isPartOfOption($option, $user)) {
                            echo 'X';
                        } else {
                            echo '';
                        }
                    }
                    echo '</td>';
                }
                ?>
            </tr>
        <?php
        }
    }

    function isPartOfOption($option, $user) {
            foreach ($user[0] as $userOption) {
                if ($userOption === $option) {
                    return true;
                }
            }
            return false;
    }

    function printUser($poll) {
        $options = unserialize($poll['custom']);
        ?>
        <tr>
            <td>
            <?php
            echo $_SESSION['name'];
            ?>
            </td>
            <?php

                foreach ($options as $option) {
                    ?>
                    <td>
                        <input added_date="<?php echo $option; ?>" class="joining-image" type="checkbox" value="<?php echo $option; ?>">
                    </td>
                    <?php
                }

            ?>
        </tr>
        <?php
    }

}

